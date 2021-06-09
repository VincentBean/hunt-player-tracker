<template>
    <div>
        <CompoundControls v-for="c in this.mapCompounds" :code="c.code" :name="c.name"/>
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


                ]
            }
        }
    },

    computed: {
        mapCompounds() {
            return this.compounds[this.$parent.map]
        }
    }

}
</script>

<style scoped>

</style>
