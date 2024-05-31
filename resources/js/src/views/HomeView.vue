<script lang="ts" setup>
import { ref, computed } from 'vue'
import { useRouter } from 'vue-router'
import { useFetch } from '@vueuse/core'
import FilesUpload from '../components/FilesUpload.vue'

const router = useRouter()

let maxFilesQuantity: number = 5
let fileTypes: Array<string> = ['image/jpeg', 'image/png']

const imagesForUpload = ref<Array<File>>([])
const links = ref<Array<string>>([])
const isActive = computed(() => imagesForUpload.value.length > 0)

console.log(isActive.value)

function saveImages() {
    const queryUrl: string = `http://${window.location.host}/api/V1/upload/images`
    const formData: FormData = new FormData()
    formData.append('_method', 'POST')
    imagesForUpload.value.forEach((image) => {
        formData.append('images[]', image)
    })

    const {
        execute: uploadImages,
        isFetching,
        error,
        data,
    } = useFetch(
        queryUrl,
        {
            body: formData,
        },
        { immediate: false }
    ).post()
    uploadImages().then((res) => {
        router.push({
            path: '/gallery',
        })
    })
}

function onChange(e) {
    e.forEach((image) => {
        if (imagesForUpload.value.length < maxFilesQuantity) {
            imagesForUpload.value.push(image)
            links.value.push(URL.createObjectURL(image))
        }
    })
    console.log(isActive.value)
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
            :disabled="!isActive"
            type="submit"
            class="text-white bg-accent hover:bg-orange-800 focus:outline-none focus:ring-4 focus:ring-orange-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800"
            :class="{ 'cursor-not-allowed': !isActive, grayscale: !isActive }"
        >
            Sabmit
        </button>
    </form>
</template>
