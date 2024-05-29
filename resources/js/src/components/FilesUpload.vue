<script lang="ts" setup>
import { ref } from 'vue'

// defineProps<{
//     fileTypes: Array<string>
// }>()

const props = defineProps({
    fileTypes: {
        type: Array<string>,
        required: true,
    },
})

const emit = defineEmits(['change'])
const draging = ref(false)
const uploadForm = ref(null)

const maxFilesQuantity = 5
const types = ['image/jpeg', 'image/png']
let imagesForUpload = []

function onDrop(e: DragEvent) {
    draging.value = false
    const files = e.dataTransfer?.files
    let res = Array.from(files)
    res = res.filter((file) => props.fileTypes.includes(file.type))
    emit('change', res)
}
function onChange(e: Event) {
    const files = (e.target as HTMLInputElement).files
    // addFiles(files)
    // console.log(uploadForm.value)
    let res = Array.from(files)
    res = res.filter((file) => props.fileTypes.includes(file.type))
    emit('change', res)
}

function addFiles(files: FileList) {
    for (let file of files) {
        if (
            types.includes(file.type) &&
            imagesForUpload.length < maxFilesQuantity
        ) {
            imagesForUpload.push(file)
            // let imageTmpUrl = URL.createObjectURL(files)
        }
    }
}
</script>
<template>
    <div
        id="drag-and-drop"
        class="flex items-center justify-center w-1/4"
        @dragover.prevent="draging = true"
        @dragleave.prevent="draging = false"
        @drop.prevent="onDrop"
    >
        <label
            for="dropzone-file"
            class="flex flex-col items-center justify-center w-full min-w-64 h-64 border-2 border-gray-300 border-dashed rounded-3xl cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-none dark:hover:border-gray-500 dark:hover:bg-gray-600"
        >
            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                <ion-icon
                    class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400"
                    aria-hidden="true"
                    name="cloud-upload-outline"
                ></ion-icon>
                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                    <span class="font-semibold">Click to upload</span> or drag
                    and drop
                </p>
                <p class="text-xs text-gray-500 dark:text-gray-400">
                    PNG or JPG
                </p>
            </div>
            <input
                ref="uploadFile"
                id="dropzone-file"
                type="file"
                name="dropzone-file"
                class="hidden"
                accept="image/*"
                multiple
                @change="onChange"
            />
        </label>
    </div>
</template>
