<template>
    <div class="small-line-height">
        <span class="is-family-monospace is-size-7" v-for="(val, key) in formattedData">
            {{ key }}: {{ val }}<br>
        </span>
        <button class="button is-light is-small" @click="limit += 5"
                v-if="Object.keys(data).length > limit">
            Show more
        </button>
        <button class="button is-light is-small" @click="limit -= 5" v-if="limit > 5">
            Show less
        </button>
    </div>
</template>

<script>
    export default {
        name: "TranslationTablePreview",
        props: ['data'],
        data() {
            return {
                limit: 5
            }
        },
        computed: {
            formattedData() {
                // Object.entries: {a: 'b', c: 'd'} => [['a', 'b'], ['c', 'd']]
                // Object.fromEntries: [['a', 'b'], ['c', 'd']] => {a: 'b', c: 'd'}
                return Object.fromEntries(
                    Object.entries(this.data).slice(0, this.limit)
                )
            }
        }
    }
</script>

<style scoped>
.small-line-height {
    line-height: 0.7rem;
}
</style>
