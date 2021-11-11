<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

class Graph extends Model
{
    public Collection $vertices;

    public Collection $edges;

    // Avg minutes spent on a compound, used for shifting the weights
    protected const MINS_PER_COMPOUND = 2;

    public function __construct(public string $map)
    {
        $this->vertices = new Collection();
        $this->edges = new Collection();
    }

    public function toJson($options = 0): string
    {
        return json_encode([
            'vertices' => $this->vertices->toArray(),
            'edges' => $this->edges->toArray()
        ]);
    }

    public function fromJson($value, $asObject = false): self
    {
        $data = json_decode($value, true);

        $this->vertices = collect($data['vertices']);
        $this->edges = collect($data['edges']);

        return $this;
    }

    public function fromFile(): self
    {
        $edges = json_decode(File::get(storage_path('app/data/' . $this->map . '.json')), true);

        $spawnPointCount = [];

        foreach ($edges as $vertex => $connectedVertices) {

            $spawnPointCount[$vertex] = 0;

            $vertices = collect($connectedVertices)->push($vertex);

            $this->vertices = $this->vertices->merge($vertices)->unique()->reject(fn($v) => str_contains($v, '_SP'));

            foreach ($connectedVertices as $connected) {

                if (str_contains($connected, '_SP')) {
                    $spawnPointCount[$vertex]++;
                    continue;
                }

                $edge = [
                    'a' => $vertex,
                    'b' => $connected,
                    'dir' => '='
                ];

                if (!$this->edges->has($edge)) {
                    $this->edges->push($edge);
                }
            }
        }

        $this->vertices = $this->vertices->map(function ($vertex) use ($spawnPointCount) {

            return [
                'code' => $vertex,
                'weight' => ($spawnPointCount[$vertex] ?? 0),
                'excluded' => false,
                'area' => 0
            ];

        });

        $this->calculatePercentages();

        return $this;
    }

    protected function getEdges(string $vertex): Collection
    {
        return $this->edges->where('a', '=', $vertex)
            ->merge($this->edges->where('b', '=', $vertex))->map(function ($edge) use ($vertex) {
                if ($edge['a'] == $vertex) {
                    return $edge;
                }

                $dir = '=';
                if ($edge['dir'] != '=') {
                    $dir = $edge['dir'] == '<' ? '>' : '<';
                }

                return ['a' => $vertex, 'b' => $edge['a'], 'dir' => $dir];
            });
    }

    public function shiftWeights()
    {
        $weightCalcs = new Collection();

        foreach ($this->vertices->where('weight', '>', 0) as $sourceVertex) {

            $edges = $this->getEdges($sourceVertex['code'])->where('dir', '!=', '<');

            if ($sourceVertex['weight'] == 0 || $edges->count() == 0) {
                continue;
            }

            $distributedWeight = ($sourceVertex['weight'] / $edges->count()) / self::MINS_PER_COMPOUND;

            foreach ($edges->pluck('b') as $targetVertex) {
                $weightCalcs[$targetVertex] = $distributedWeight;

                $weightCalcs[] = ['code' => $targetVertex, 'operator' => '+', 'amount' => $distributedWeight];
            }

            $weightCalcs[] = ['code' => $sourceVertex['code'], 'operator' => '-', 'amount' => $distributedWeight * $edges->count()];
        }

        // Apply the weight changes
        $this->vertices = $this->vertices->map(function ($v) use ($weightCalcs) {

            $vertexCalcs = $weightCalcs->where('code', '=', $v['code']);

            foreach ($vertexCalcs as $calc) {
                if ($calc['operator'] == '-') {
                    $v['weight'] -= $calc['amount'];
                }

                if ($calc['operator'] == '+') {
                    $v['weight'] += $calc['amount'];
                }
            }

            return $v;
        });

        $this->calculatePercentages();
    }

    public function calculatePercentages(): self
    {
        $totalWeight = $this->vertices->sum('weight');

        $this->vertices = $this->vertices->map(function ($v) use ($totalWeight) {

            $v['percent'] = round(($v['weight'] /  $totalWeight) * 100, 2);

            return $v;
        });

        return $this;
    }

    public function exclude(string $code)
    {
        $this->vertices = $this->vertices->map(function ($v) use ($code) {
            if ($v['code'] != $code) {
                return $v;
            }

            $v['excluded'] = true;

            return $v;
        });

        $this->edges = $this->edges->map(function ($e) use ($code) {

            if (($e['a'] == $code || $e['b'] == $code) && $e['dir'] != '=') {
                $e['dir'] = '=';
                return $e;
            }

            if ($e['a'] == $code) {
                $e['dir'] = '>';
            }

            if ($e['b'] == $code) {
                $e['dir'] = '<';
            }

            return $e;
        });

        return $this;
    }

    public function include(string $code): self
    {
        $this->vertices = $this->vertices->map(function ($v) use ($code) {
            if ($v['code'] != $code) {
                return $v;
            }

            $v['excluded'] = false;

            return $v;
        });

        $this->edges = $this->edges->map(function ($e) use ($code) {

            if (($e['a'] == $code || $e['b'] == $code) && $e['dir'] != '=') {
                $e['dir'] = '=';
                return $e;
            }

            return $e;
        });

        return $this;
    }
}
