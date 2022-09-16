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

const addForm = useForm();
const subtractForm = useForm();

const hasCard = (quantity) => quantity !== 0;

const state = reactive({ selected: null });

const isSelected = (id) => id === state.selected;

const selectCard = (cardId) => {
    state.selected = cardId;
    document.body.classList.add("overflow-hidden");
};

const resetSelected = () => {
    state.selected = null;
    document.body.classList.remove("overflow-hidden");
};
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Album: {{ album.description }}

                <Link
                    :href="`/album/${album.id}/missing-cards`"
                    class="block text-base underline text-indigo-600"
                    >Ver só as figurinhas que faltam</Link
                >
            </h2>
        </template>

        <div class="py-12">
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
                                <div
                                    :class="{
                                        'fixed inset-0 w-full h-full z-30':
                                            isSelected(card.id),
                                    }"
                                    class="flex items-center justify-center"
                                >
                                    <button
                                        v-if="isSelected(card.id)"
                                        @click="resetSelected()"
                                        class="absolute inset-0 w-full h-full z-20 backdrop-blur-sm bg-white/70"
                                    ></button>

                                    <div
                                        @click="selectCard(card.id)"
                                        :class="{
                                            'bg-gray-200 border-gray-300':
                                                !hasCard(card.quantity) &&
                                                !isSelected(card.id),
                                            'bg-indigo-200 border-indigo-500':
                                                hasCard(card.quantity) ||
                                                isSelected(card.id),
                                            'z-10 h-32 w-full': !isSelected(
                                                card.id
                                            ),
                                            'w-48 h-72 z-30 shadow-lg py-16':
                                                isSelected(card.id),
                                        }"
                                        class="relative cursor-pointer font-initials border-8 flex items-start justify-center px-4 py-4"
                                    >
                                        <span
                                            class="w-16 font-black text-2xl -tracking-wide leading-none text-gray-400 text-center"
                                            :class="{
                                                'text-indigo-500':
                                                    hasCard(card.quantity) ||
                                                    isSelected(card.id),
                                                'text-4xl w-24': isSelected(
                                                    card.id
                                                ),
                                            }"
                                        >
                                            {{ card.code }}
                                        </span>

                                        <span
                                            v-if="
                                                hasCard(card.quantity) ||
                                                isSelected(card.id)
                                            "
                                            :class="{
                                                'py-1 px-2': !isSelected(
                                                    card.id
                                                ),
                                                'text-3xl py-2 px-4 bottom-10':
                                                    isSelected(card.id),
                                            }"
                                            class="absolute bottom-2 font-code text-lg text-indigo-600 bg-white border-4 border-indigo-500 leading-none rounded-full"
                                        >
                                            {{ card.quantity }}
                                        </span>
                                    </div>

                                    <div
                                        v-if="isSelected(card.id)"
                                        class="w-full fixed bottom-0 right-0 left-0 z-30 flex"
                                    >
                                        <button
                                            @click.prevent="
                                                addForm.patch(
                                                    `/card/${card.id}/add-quantity`,
                                                    { preserveScroll: true }
                                                )
                                            "
                                            :disabled="addForm.processing"
                                            class="relative flex-1 bg-emerald-400 disabled:bg-emerald-100 flex items-center justify-center p-4 text-white uppercase font-bold text-sm"
                                        >
                                            <span v-if="!addForm.processing">
                                                adicionar
                                            </span>

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
                                            @click.prevent="
                                                subtractForm.patch(
                                                    `/card/${card.id}/subtract-quantity`,
                                                    { preserveScroll: true }
                                                )
                                            "
                                            :disabled="subtractForm.processing"
                                            class="relative flex-1 bg-red-400 disabled:bg-red-100 flex items-center justify-center p-4 text-white uppercase font-bold text-sm"
                                        >
                                            <span
                                                v-if="!subtractForm.processing"
                                            >
                                                remover
                                            </span>

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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
