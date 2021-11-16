<template>
    <div class="pt-8">
        <div v-if="!activeMatch">
            <!--            <MapPicker/>-->
            <div class="flex mt-8">
                <button v-on:click="startMatch()" type="button"
                        class="mx-auto inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-gray-200 border-red-800 bg-red-900 hover:bg-red-800 focus:outline-none">
                    Start match
                </button>
            </div>
        </div>

        <h1 class="text-red-800 text-4xl text-center">Countdown: {{ minutesLeft }}</h1>

        <div class="flex space-x-2 mt-4">
            <Map ref="map"/>
            <Controls ref="controls" class="flex-1 text-white p-4 border border-red-800"/>
        </div>

        <button v-on:click="shiftWeights()" type="button"
                class="mx-auto inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-gray-200 border-red-800 bg-red-900 hover:bg-red-800 focus:outline-none">
            Shift weights
        </button>
        <button v-on:click="resetMap()" type="button"
                class="mx-auto inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-gray-200 border-red-800 bg-red-900 hover:bg-red-800 focus:outline-none">
            Reset
        </button>
        <button v-on:click="resetTracker()" type="button"
                class="mx-auto inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-gray-200 border-red-800 bg-red-900 hover:bg-red-800 focus:outline-none">
            Hard reset
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
            lobby: null,
            minutesLeft: 60
        }
    },

    mounted() {

        this.lobby = window.localStorage.getItem('code')
        this.map = window.localStorage.getItem('map')

        if (this.lobby == null || this.lobby == '' || this.map == null) {
            alert('No lobby code or map found');
            window.location.href = '/';
            return;
        }

        let self = this;
        Echo.channel('lobby.' + this.getLobby())
            .listen('UpdateLobby', (data) => {
                self.activeMatch = data.started;
                self.minutesLeft = data.minutesLeft;
            })

        axios.get('/get/' + this.lobby);
    },

    methods: {
        startMatch() {
            axios.get('/start/' + this.lobby);
        },

        shiftWeights() {
            axios.get('/update/' + this.lobby);
        },

        resetMap() {
            axios.get('/reset/' + this.lobby);
        },

        updateControls(vertices) {
            this.$refs.controls.updateControls(vertices)
        },

        getLobby() {
            return window.localStorage.getItem('code');
        },

        resetTracker() {
            if (!confirm('This will kick you out of this lobby!')) {
                return;
            }

            window.localStorage.clear();
            window.location.replace('/')
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
