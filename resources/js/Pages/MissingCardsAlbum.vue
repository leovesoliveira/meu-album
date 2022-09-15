<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";
import { reactive } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";

defineProps({
    album: Object,
    cards: Object,
});
</script>

<template>
    <div class="flex flex-col bg-gray-100 border-t-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
            <h2
                class="font-black text-2xl text-indigo-600 text-center leading-tight"
            >
                Album: {{ album.description }}
                <span class="block uppercase text-base mt-4 text-slate-400"
                    >Faltam as seguintes figurinhas</span
                >
            </h2>
        </div>

        <div class="pb-12 pt-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="grid grid-cols-3 gap-4 px-4 sm:px-0 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-6 xl:grid-cols-7"
                >
                    <div v-for="card in cards">
                        <div class="flex items-center justify-center">
                            <div
                                class="h-36 w-full font-initials border-8 flex items-center justify-center px-4 py-8 bg-gray-200 border-gray-300"
                            >
                                <span
                                    class="w-16 font-black text-2xl -tracking-wide leading-none text-gray-400 text-center"
                                >
                                    {{ card.code }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
