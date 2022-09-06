<template>
    <AppLayout>
        <div class="bg-red-200 p-4">
            <qrcode-stream :camera="camera" @decode="onDecode" @init="onInit" />
        </div>

    </AppLayout>
</template>

<script>
import { QrcodeStream } from "vue3-qrcode-reader";
import AppLayout from "@/Layouts/AppLayout.vue";

export default {

    components: {AppLayout, QrcodeStream },

    data () {
        return {
            camera: 'rear',

            result: '',
            error: ''
        }
    },

    methods: {
        onDecode (result) {
            this.result = result
        },

        async onInit (promise) {
        }
    }
}
</script>

<style scoped>
.error {
    font-weight: bold;
    color: red;
}
</style>
