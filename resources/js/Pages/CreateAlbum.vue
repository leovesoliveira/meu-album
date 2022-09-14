<script setup>
import { Link, useForm } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import ActionMessage from "@/Components/ActionMessage.vue";
import FormSection from "@/Components/FormSection.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

const form = useForm({
    code: "",
    description: "",
});

const storeAlbum = () => {
    form.post(route("album.store"), {
        errorBag: "updateProfileInformation",
        preserveScroll: true,
    });
};
</script>

<template>
    <AppLayout title="Adiciona Álbum">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Adicionar Álbum
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <FormSection @submitted="storeAlbum">
                    <template #title> Informações do Álbum </template>

                    <template #description>
                        Coloque abaixo o <strong>códido do album</strong>,
                        encontrado na primeira página do mesmo, e uma
                        <strong>descrição</strong>
                        a sua escolha para facilitar a identificação para você.
                    </template>

                    <template #form>
                        <!-- Name -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="code" value="Código do Album" />

                            <TextInput
                                id="code"
                                v-model="form.code"
                                type="text"
                                class="mt-1 block w-full"
                                autocomplete="name"
                            />
                            <InputError
                                :message="form.errors.code"
                                class="mt-2"
                            />
                        </div>

                        <!-- Email -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="description" value="Descrição" />

                            <TextInput
                                id="description"
                                v-model="form.description"
                                type="text"
                                class="mt-1 block w-full"
                            />
                            <InputError
                                :message="form.errors.description"
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
                            Adicionar
                        </PrimaryButton>
                    </template>
                </FormSection>
            </div>
        </div>
    </AppLayout>
</template>
