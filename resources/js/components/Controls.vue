<template>
    <div>
        <div class="overflow-hidden sm:rounded-md">
            <ul class="divide-y divide-gray-600">
                <CompoundControls :ref="c.code" v-for="c in this.mapCompounds" :code="c.code" :name="c.name"
                                  />
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
            lobby: this.$parent.lobby,
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
                        name: 'Cyprus Huts',
                        code: 'CH'
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

                ]
            }
        }
    },

    computed: {
        mapCompounds() {
            return this.compounds[this.$parent.map]
        }
    },

    methods: {
        updateControls(vertices) {
            for (let c in this.mapCompounds) {

                let compound = this.mapCompounds[c]
                console.log(compound.code)

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
        }
    }

}
</script>

<style scoped>

</style>
