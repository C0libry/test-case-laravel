<script lang="ts" setup>
import { ref, computed } from 'vue'
import { useFetch } from '@vueuse/core' // https://vueuse.org/core/useFetch/
import { TailwindPagination } from 'laravel-vue-pagination'
import { format } from 'date-fns'

const page = ref<number>(1)
const sort = ref<string>('created_at')
const dir = ref<'asc' | 'desc'>('desc')
const queryUrl = computed(() => {
    return `http://${window.location.host}/api/V1/images?page=${page.value}&sort=${sort.value}&dir=${dir.value}`
})

const {
    isFetching,
    error,
    data: imagesData,
} = useFetch(queryUrl, { refetch: true }).get().json()

const setPage = (newPage: number) => (page.value = newPage)
</script>
<template>
    <div class="flex justify-center items-center flex-col">
        <div class="flex justify-center pt-10">
            <div id="sort" class="flex gap-8" method="GET">
                <select
                    ref="abc"
                    v-model="sort"
                    id="sort-selector"
                    name="sort"
                    @change="page = 1"
                    class="bg-gray-50 border border-gray-700 text-gray-900 mb-6 text-sm rounded-lg focus:ring-accent focus:border-accent block w-64 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                >
                    <option value="created_at">Sort by upload date</option>
                    <option value="name">Sort by name</option>
                </select>
                <button
                    v-if="dir === 'asc'"
                    @click=";(dir = 'desc'), (page = 1)"
                    class="dark:bg-gray-700 dark:text-white flex items-center justify-center text-xl h-10 w-10 rounded-lg border border-gray-700 focus:ring-accent focus:border-accent"
                >
                    <ion-icon name="chevron-down-outline"></ion-icon>
                </button>
                <button
                    v-else="dir === 'desc'"
                    @click=";(dir = 'asc'), (page = 1)"
                    class="dark:bg-gray-700 dark:text-white flex items-center justify-center text-xl h-10 w-10 rounded-lg border border-gray-700 focus:ring-accent focus:border-accent"
                >
                    <ion-icon name="chevron-up-outline"></ion-icon>
                </button>
            </div>
        </div>
        <div class="flex justify-center">
            <div
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 w-4/5 py-10"
                v-if="imagesData"
            >
                <div
                    class="h-full max-w-full flex flex-col"
                    v-for="(image, index) in imagesData.data.data"
                    :key="index"
                >
                    <a :href="image.path">
                        <img
                            class="w-full h-96 rounded-t-lg"
                            :src="image.path"
                            alt=""
                    /></a>
                    <div
                        class="flex justify-between items-center py-4 w-full rounded-b-lg bg-gray-900 text-gray-50"
                    >
                        <div class="w-1/4 text-center">
                            {{
                                format(
                                    new Date(image.created_at),
                                    'dd.MM.yyyy HH:mm:ss'
                                )
                            }}
                        </div>
                        <div class="w-1/2 text-center break-words text-active">
                            {{ image.name }}
                        </div>
                        <a
                            class="w-1/4 text-center"
                            :href="`/api/V1/download/images/${image.id}`"
                        >
                            <ion-icon
                                class="size-5 md:size-8 hover:text-accent"
                                name="cloud-download-outline"
                            ></ion-icon>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <TailwindPagination
            class="pb-5"
            :limit="1"
            :activeClasses="[
                'bg-orange-50',
                'border-orange-500',
                'text-orange-600',
            ]"
            v-if="imagesData"
            :data="imagesData.data"
            @pagination-change-page="setPage"
        />
    </div>
</template>
