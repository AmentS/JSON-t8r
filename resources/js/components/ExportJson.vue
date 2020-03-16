<template>
    <div>
        <input type="button" value="Export to JSON" @click="exportFile()" class="button is-success">
        <a style="display:none" :href="dataString" :download="fileName" ref="downloader"></a>

    </div>
</template>

<script>

    export default {

        props: {
            storageObj: Object,
            fileName: String
        },


        methods: {
            exportFile() {
                this.$refs.downloader.click();
            }
        },
        computed: {
            dataString() {
                return "data:text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(this.storageObj, null, 2));
            }
        }

    }
</script>