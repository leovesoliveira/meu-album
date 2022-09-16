<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";
import { reactive } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";

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

const addForm = useForm({
    cards: [],
});

const subtractForm = useForm({
    cards: [],
});

const addCards = (albumId, cards) => {
    const cardsIds = [];

    Object.values(cards).forEach((card) => {
        Object.values(card).forEach((item) => {
            cardsIds.push(item.id);
        });
    });

    addForm
        .transform((data) => {
            return { cards: cardsIds };
        })
        .patch(`/album/${albumId}/add-cards-quantity`, {
            preserveScroll: true,
        });
};

const subtractCards = (albumId, cards) => {
    const cardsIds = [];

    Object.values(cards).forEach((card) => {
        Object.values(card).forEach((item) => {
            cardsIds.push(item.id);
        });
    });

    subtractForm
        .transform((data) => {
            return { cards: cardsIds };
        })
        .patch(`/album/${albumId}/subtract-cards-quantity`, {
            preserveScroll: true,
        });
};
</script>

<template>
    <AppLayout title="Confirmação de Figurinhas">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Confirmação de Figurinhas
            </h2>
        </template>

        <div class="pb-12 pt-4">
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
                            class="grid grid-cols-4 gap-2 sm:grid-cols-5 md:grid-cols-6 lg:grid-cols-7 xl:grid-cols-8"
                        >
                            <div v-for="card in cardsBySubType">
                                <div class="flex items-center justify-center">
                                    <div
                                        class="font-initials border-8 flex items-center justify-center px-4 py-4 z-10 h-32 w-full bg-indigo-200 border-indigo-500"
                                    >
                                        <span
                                            class="w-16 font-black text-2xl -tracking-wide leading-none text-center text-indigo-500"
                                        >
                                            {{ card.code }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full fixed bottom-0 right-0 left-0 z-30 flex">
                    <button
                        @click.prevent="addCards(album.id, cards)"
                        :disabled="addForm.processing"
                        class="relative flex-1 bg-emerald-400 disabled:bg-emerald-100 flex items-center justify-center p-4 text-white uppercase font-bold text-sm"
                    >
                        <span v-if="!addForm.processing"> adicionar </span>

                        <div
                            v-else
                            class="absolute inset-0 w-full h-full text-emerald-400"
                        >
                            <svg
                                class="w-full h-full"
                                version="1.1"
                                id="L9"
                                xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                x="0px"
                                y="0px"
                                viewBox="0 0 100 100"
                                enable-background="new 0 0 0 0"
                                xml:space="preserve"
                            >
                                <path
                                    fill="currentColor"
                                    d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50"
                                >
                                    <animateTransform
                                        attributeName="transform"
                                        attributeType="XML"
                                        type="rotate"
                                        dur="1s"
                                        from="0 50 50"
                                        to="360 50 50"
                                        repeatCount="indefinite"
                                    />
                                </path>
                            </svg>
                        </div>
                    </button>

                    <button
                        @click.prevent="subtractCards(album.id, cards)"
                        :disabled="subtractForm.processing"
                        class="relative flex-1 bg-red-400 disabled:bg-red-100 flex items-center justify-center p-4 text-white uppercase font-bold text-sm"
                    >
                        <span v-if="!subtractForm.processing"> remover </span>

                        <div
                            v-else
                            class="absolute inset-0 w-full h-full text-red-400"
                        >
                            <svg
                                class="w-full h-full"
                                version="1.1"
                                id="L9"
                                xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                x="0px"
                                y="0px"
                                viewBox="0 0 100 100"
                                enable-background="new 0 0 0 0"
                                xml:space="preserve"
                            >
                                <path
                                    fill="currentColor"
                                    d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50"
                                >
                                    <animateTransform
                                        attributeName="transform"
                                        attributeType="XML"
                                        type="rotate"
                                        dur="1s"
                                        from="0 50 50"
                                        to="360 50 50"
                                        repeatCount="indefinite"
                                    />
                                </path>
                            </svg>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
