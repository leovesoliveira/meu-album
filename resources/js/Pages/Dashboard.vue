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
                    <Link
                        :href="`/album/${album.id}`"
                        v-for="album in albums"
                        class="bg-white px-4 py-6 flex justify-between items-center shadow sm:rounded"
                    >
                        <p class="text-xl text-slate-700">
                            {{ album.description }}
                        </p>

                        <p
                            class="px-3 py-1 font-code bg-slate-100 border-2 border-dotted border-slate-300 text-slate-700 tracking-widest rounded"
                        >
                            {{ album.code }}
                        </p>
                    </Link>
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
