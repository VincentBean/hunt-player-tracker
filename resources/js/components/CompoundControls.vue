<template>
    <div>
        <button v-on:click="exclude(code)" type="button"
                class="mx-auto inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-gray-200 border-red-800 bg-red-900 hover:bg-red-800 focus:outline-none">
            Exclude {{ name }}
        </button>
    </div>
</template>

<script>
export default {
    name: "CompoundControls",
    props: ['code', 'name'],



    methods: {
        exclude() {
            window.axios.post('/vertex/exclude', {lobby: this.$parent.lobby, code: this.code});
        }
    }
}
</script>

<style scoped>

</style>
