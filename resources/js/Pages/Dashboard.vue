<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";

defineProps({
    albums: Array,
});
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="px-4 sm:px-0 mb-4">
                    <h3 class="text-lg font-medium text-gray-900">
                        Seus Álbuns
                    </h3>
                </div>

                <div v-if="albums.length" class="flex flex-col gap-4">
                    <div
                        :href="`/album/${album.id}`"
                        v-for="album in albums"
                        class="relative bg-white flex justify-between items-center shadow sm:rounded overflow-hidden"
                    >
                        <Link
                            :href="`/album/${album.id}`"
                            class="pl-4 pr-20 py-6 w-full flex flex-col items-start"
                        >
                            <div class="w-full flex flex-wrap items-center mb-1 justify-between">
                                <p class="text-xl text-slate-700 mb-1">
                                    {{ album.description }}
                                </p>

                                <p class="px-3 py-1 mb-2 font-code bg-slate-100 border-2 border-dotted border-slate-300 text-slate-700 tracking-widest rounded">
                                    {{ album.code }}
                                </p>
                            </div>

                            <p class="w-full text-md text-blue-600 mb-1 border-b border-slate-200 flex justify-between">
                                <span>Total: </span>
                                <span><strong class="font-bold">{{ album.total_quantity_cards }}</strong> figurinhas</span>
                            </p>

                            <p class="w-full text-md text-yellow-600 mb-1 border-b border-slate-200 flex justify-between">
                                <span>Repetidas: </span>
                                <span><strong class="font-bold">{{ album.total_quantity_repeated_cards }}</strong> figurinhas</span>
                            </p>

                            <p class="w-full text-md text-red-600 mb-2 flex justify-between">
                                <span>Faltam: </span>
                                <span><strong class="font-bold">{{ album.total_missing_cards }}</strong> figurinhas</span>
                            </p>

                            <div class="w-full relative flex justify-between bg-slate-400 px-2 py-1 rounded overflow-hidden">
                                <p class="font-bold text-white z-10">
                                    {{ album.percent_complete }}%
                                </p>

                                <p class="font-bold text-white z-10">
                                    {{ album.total_at_least_one_cards }} / {{ album.total_cards }}
                                </p>

                                <div class="absolute inset-0 flex">
                                    <div class="bg-indigo-800" :style="`width:${album.percent_complete}%`"></div>
                                </div>
                            </div>
                        </Link>

                        <Link
                            :href="`/album/${album.id}/edit`"
                            class="flex items-center absolute top-0 right-0 bottom-0 px-2 border-l border-slate-100 bg-slate-50 text-slate-300"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="icon icon-tabler icon-tabler-settings"
                                width="44"
                                height="44"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                fill="none"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <path
                                    stroke="none"
                                    d="M0 0h24v24H0z"
                                    fill="none"
                                />
                                <path
                                    d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z"
                                />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                        </Link>
                    </div>
                </div>

                <div v-else>
                    <h3 class="px-4 text-lg text-slate-400">
                        Você ainda não tem nenhum álbum adicionado!
                    </h3>
                </div>

                <Link
                    class="block px-4 py-6 underline text-slate-400 sm:px-0"
                    href="/album/create"
                    >Adicionar Álbum</Link
                >
            </div>
        </div>
    </AppLayout>
</template>
