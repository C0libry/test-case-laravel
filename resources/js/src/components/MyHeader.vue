<script lang="ts" setup>
// import { defineComponent } from 'vue'
</script>
<template>
    <header
        class="flex justify-between items-center px-24 py-8 bg-gray-900 text-gray-50"
    >
        <router-link to="/">
            <ion-icon
                class="size-10 md:size-16 hover:text-orange-500 transition-all duration-300"
                name="cloud-upload-outline"
            ></ion-icon>
        </router-link>
        <nav>
            <ul>
                <li>
                    <router-link to="/gallery">
                        <ion-icon
                            class="size-10 md:size-16 hover:text-orange-500 transition-all duration-300"
                            name="image-outline"
                        ></ion-icon>
                    </router-link>
                </li>
            </ul>
        </nav>
    </header>
</template>
