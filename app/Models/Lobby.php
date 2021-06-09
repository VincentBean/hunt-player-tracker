<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lobby extends Model
{
    use HasFactory;

    public ?Graph $graphModel = null;

    public function newGraph()
    {
        $this->graphModel = new Graph($this->map);
        $this->graphModel->constructFromFile();
    }

    public function save(array $options = [])
    {
        if (!is_null($this->graphModel)) {
            $this->graph = $this->graphModel->toJson();
        }

        return parent::save($options);
    }

    public function getGraph()
    {
        if (is_null($this->graphModel)) {
            if (blank($this->graph)) {
                $this->graphModel = (new Graph($this->map))->fromFile();
                $this->save();
            } else {
                $this->graphModel = (new Graph($this->map))->fromJson($this->graph);
            }
        }


        return $this->graphModel;
    }
}
