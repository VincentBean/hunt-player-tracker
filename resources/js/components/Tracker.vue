<template>
    <div class="pt-8">
        <div v-if="!activeMatch">
            <MapPicker/>
            <div class="flex mt-8">
                <button v-if="map != null" v-on:click="startMatch()" type="button"
                        class="mx-auto inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-gray-200 border-red-800 bg-red-900 hover:bg-red-800 focus:outline-none">
                    Start match
                </button>
            </div>
        </div>


        <Countdown ref="countdown"/>

        <div class="flex space-x-2 mt-4">
            <Map ref="map"/>
            <Controls ref="controls" class="flex-1 text-white p-4 border border-red-800"/>
        </div>

        <button v-on:click="updateMap()" type="button"
                class="mx-auto inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-gray-200 border-red-800 bg-red-900 hover:bg-red-800 focus:outline-none">
            Update map
        </button>
        <button v-on:click="resetMap()" type="button"
                class="mx-auto inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-gray-200 border-red-800 bg-red-900 hover:bg-red-800 focus:outline-none">
            Reset map
        </button>
    </div>
</template>

<script>
import MapPicker from "./MapPicker";

export default {
    name: "Tracker",
    components: {MapPicker},
    data() {
        return {
            map: null,
            activeMatch: false,
            lobby: 'lob'
        }
    },

    mounted() {
        this.map = 'bayou'
        this.startMatch()
    },

    methods: {
        startMatch() {
            this.activeMatch = true
            this.$refs.countdown.start()
        },

        updateMap() {
            axios.get('/update/' + this.lobby);
        },

        resetMap() {
            axios.get('/reset/' + this.lobby);
        },

        updateControls(vertices) {
            this.$refs.controls.updateControls(vertices)
        }
    },

    watch: {
        map() {
            this.$refs.map.drawMap(this.map)
        }
    }
}
</script>

<style scoped>

</style>
