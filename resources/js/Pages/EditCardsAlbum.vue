<script setup>
import { Link, useForm } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import ActionMessage from "@/Components/ActionMessage.vue";
import FormSection from "@/Components/FormSection.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

defineProps({
    album: Object,
});

const form = useForm({
    cards: "",
});

const fetchCards = (albumId) => {
    form.get(route("album.edit-cards-confirmation", albumId), {
        preserveScroll: true,
    });
};
</script>

<template>
    <AppLayout :title="`Figurinhas do Álbum: ${album.description}`">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Figurinhas do Álbum: {{ album.description }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <FormSection @submitted="fetchCards(album.id)">
                    <template #title>Adicionar/Remover Figurinhas</template>

                    <template #description>
                        Adicione ou remova várias figurinhas de forma mais
                        rápida, de uma vez só.<br />Irá adicionar +1 ou remover
                        -1 na quantidade de cada figurinha que você colocar.
                        <br /><br />Precisa ser escrito no seguinte formato,
                        segue o exemplo:<br /><br />
                        <strong>00|FWC:1,3,10|BRA:3,8,17|C:4,8</strong>
                    </template>

                    <template #form>
                        <!-- Name -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="cards" value="Figurinhas" />

                            <TextInput
                                id="cards"
                                v-model="form.cards"
                                type="text"
                                class="mt-1 block w-full"
                            />
                            <InputError
                                :message="form.errors.cards"
                                class="mt-2"
                            />
                        </div>
                    </template>

                    <template #actions>
                        <ActionMessage
                            :on="form.recentlySuccessful"
                            class="mr-3"
                        >
                            Saved.
                        </ActionMessage>

                        <PrimaryButton
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Próximo
                        </PrimaryButton>
                    </template>
                </FormSection>
            </div>
        </div>
    </AppLayout>
</template>
