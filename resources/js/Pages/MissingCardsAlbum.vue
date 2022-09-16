<script setup>
import { Head } from "@inertiajs/inertia-vue3";

defineProps({
    album: Object,
    cards: Object,
});

const SubTypeNames = {
    zero: "Logo Panini",
    institutional: "Logo Fifa",
    cup: "Taça",
    mascot: "Mascote",
    logo: "Logo Copa",
    stadium: "Estádios",
    ball: "Bola",
    museum: "Museu",
    coke: "Coca-Cola",
    qatar: "Qatar",
    ecuador: "Ecuador",
    senegal: "Senegal",
    netherlands: "Netherlands",
    england: "England",
    "ir-iran": "Ir Iran",
    usa: "USA",
    wales: "Wales",
    argentina: "Argentina",
    "saudi-arabia": "Saudi Arabia",
    mexico: "Mexico",
    poland: "Poland",
    france: "France",
    australia: "Australia",
    denmark: "Denmark",
    tunisia: "Tunisia",
    spain: "Spain",
    "costa-rica": "Costa Rica",
    germany: "Germany",
    japan: "Japan",
    belgium: "Belgium",
    canada: "Canada",
    morocco: "Morocco",
    croatia: "Croatia",
    brazil: "Brazil",
    serbia: "Serbia",
    switzerland: "Switzerland",
    cameroon: "Cameroon",
    portugal: "Portugal",
    ghana: "Ghana",
    uruguay: "Uruguay",
    "korea-republic": "Korea Republic",
};
</script>

<template>
    <Head :title="`Album: ${album.description}`" />

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
                <div class="flex flex-col gap-4 px-4 sm:px-0">
                    <div v-for="(cardsBySubType, subtype) in cards">
                        <h3 class="pb-4 pt-6">
                            <hr
                                class="-mb-4 border-t-2 border-indigo-400 border-dotted"
                            />

                            <span
                                class="font-bold text-xl inline-block text-indigo-600 pr-2 bg-slate-100"
                                >{{ SubTypeNames[subtype] }}</span
                            >
                        </h3>

                        <div
                            class="grid grid-cols-3 gap-4 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-6 xl:grid-cols-7"
                        >
                            <div v-for="card in cardsBySubType">
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
        </div>
    </div>
</template>
