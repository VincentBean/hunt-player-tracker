<template>
    <div>
        <div class="overflow-hidden sm:rounded-md">
            <ul class="divide-y divide-gray-600">
                <CompoundControls :ref="c.code" v-for="c in this.mapCompounds" :code="c.code" :name="c.name"
                                  :key="c.code" />
            </ul>
        </div>
    </div>
</template>

<script>
import CompoundControls from "./CompoundControls";

export default {
    name: "Controls",
    components: {CompoundControls},
    data() {
        return {
            compounds: {
                'bayou': [
                    {
                        name: 'Lockbay Docks',
                        code: 'LD'
                    },
                    {
                        name: 'Cyprus Huts',
                        code: 'CH'
                    },
                    {
                        name: 'Alain Son & Fish',
                        code: 'ASF'
                    },
                    {
                        name: 'Rynard Mill & Lumber',
                        code: 'RML'
                    },
                    {
                        name: 'Port Reeker',
                        code: 'PR'
                    },
                    {
                        name: 'Stillwater Bend',
                        code: 'SB'
                    },
                    {
                        name: 'The Chapel of Madonna Noire',
                        code: 'CMN'
                    },
                    {
                        name: 'Scupper Lake',
                        code: 'SL'
                    },
                    {
                        name: 'Catfish Grove',
                        code: 'CG'
                    },
                    {
                        name: 'Alice Farm',
                        code: 'AF'
                    },
                    {
                        name: 'Pitching Crematorium',
                        code: 'PC'
                    },
                    {
                        name: 'The Slaughterhause',
                        code: 'SH'
                    },
                    {
                        name: 'Davant Ranch',
                        code: 'DR'
                    },
                    {
                        name: 'Blanchett Graves',
                        code: 'BG'
                    },
                    {
                        name: 'Darrow Livestock',
                        code: 'DL'
                    },
                    {
                        name: 'Healing Waters Church',
                        code: 'HWC'
                    },
                ],
                'delta': [
                    { code: 'GD', name: "Godard Docks"},
                    { code: 'BB', name: "Blanc Brinery"},
                    { code: 'GA', name: "Golden Acres"},
                    { code: 'SP', name: "Salter's Pork"},
                    { code: 'MB', name: "Maw Battery"},
                    { code: 'LS', name: "Lawson Station"},
                    { code: 'WR', name: "Windy Run"},
                    { code: 'NP', name: "Nocholls Prison"},
                    { code: 'SF', name: "Sweetbell Flour"},
                    { code: 'FC', name: "Fort Carmick"},
                    { code: 'IW', name: "Iron Works"},
                    { code: 'WA', name: "Wolfshead Arsenal"},
                    { code: 'BCB', name: "Bradley & Craven Brickworks"},
                    { code: 'CAL', name: "C&A Lumber"},
                    { code: 'HH', name: "Hemlock and Hide"},
                ]
            }
        }
    },

    computed: {
        mapCompounds() {
            if (this.compounds[this.$parent.map] == undefined) {
                return []
            }
            return this.compounds[this.$parent.map].sort((a, b) => a.code.localeCompare(b.code))
        }
    },

    methods: {
        updateControls(vertices) {
            for (let c in this.mapCompounds) {

                let compound = this.mapCompounds[c]

                let vertex = null

                for (let v in vertices) {
                    if (vertices[v].code == compound.code) {
                        vertex = vertices[v]
                        break
                    }
                }

                if (vertex == null) continue;

                this.$refs[vertex.code][0].setExcluded(vertex.excluded)

            }
        },
        getLobby() {
            return this.$parent.getLobby();
        }
    }

}
</script>

<style scoped>

</style>
