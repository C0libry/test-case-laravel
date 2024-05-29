<script lang="ts" setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { useFetch } from '@vueuse/core'
import FilesUpload from '../components/FilesUpload.vue'

const router = useRouter()

let maxFilesQuantity: number = 5
let fileTypes: Array<string> = ['image/jpeg', 'image/png']
let imagesForUpload: Array<File> = []
let links = ref<Array<string>>([])

function saveImages() {
    const queryUrl: string = `http://${window.location.host}/api/V1/uploadImages`
    const formData: FormData = new FormData()
    formData.append('_method', 'POST')
    imagesForUpload.forEach((image) => {
        formData.append('images[]', image)
    })
    console.log('formData: ', formData)

    const { isFetching, error, data } = useFetch(queryUrl, {
        body: formData,
    }).post()

    router.push({
        path: '/gallery',
    })
}

function onChange(e) {
    e.forEach((image) => {
        if (imagesForUpload.length < maxFilesQuantity) {
            imagesForUpload.push(image)
            links.value.push(URL.createObjectURL(image))
        }
    })
}
</script>
<template>
    <form
        id="upload-form"
        method="POST"
        enctype="multipart/form-data"
        class="flex justify-center items-center flex-col gap-5 py-64"
        @submit.prevent="saveImages"
    >
        <FilesUpload @change="onChange" :fileTypes="fileTypes" />
        <div
            id="images-list"
            class="flex items-center justify-center flex-col md:flex-row gap-3"
        >
            <div v-for="(link, index) in links" :key="index">
                <img
                    :src="link"
                    @click="
                        links.splice(index, 1), imagesForUpload.splice(index, 1)
                    "
                    class="images-list-picture h-32 w-32 rounded-lg hover:blur-sm duration-300"
                />
            </div>
        </div>

        <button
            id="upload-btn"
            :disabled="imagesForUpload.length === 0"
            type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        >
            Sabmit
        </button>
    </form>
</template>
