<script setup>
import { ref } from "vue";
import { Link, useForm } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import ActionMessage from "@/Components/ActionMessage.vue";
import FormSection from "@/Components/FormSection.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import DangerButton from "@/Components/DangerButton.vue";
import DialogModal from "@/Components/DialogModal.vue";

defineProps({
    album: Object,
    users: Array,
});

const addUserForm = useForm({
    email: "",
});

const addUser = (albumId) => {
    addUserForm.patch(`/album/${albumId}/add-user`, {
        preserveScroll: true,
        onSuccess: () => addUserForm.reset(),
    });
};

const confirmingUserRemotion = ref(false);

const removeUserForm = useForm();

const confirmUserRemotion = () => {
    confirmingUserRemotion.value = true;
};

const removeUser = (albumId, userId) => {
    removeUserForm.patch(`/album/${albumId}/remove-user/${userId}`, {
        preserveScroll: true,
        onSuccess: () => closeModal(),
    });
};

const closeModal = () => {
    confirmingUserRemotion.value = false;
};
</script>

<template>
    <AppLayout title="`Editar Álbum: ${album.description}`">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Editar Álbum: {{ album.description }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <FormSection @submitted="addUser(album.id)">
                    <template #title>Adicionar Usários</template>

                    <template #description>
                        <p>
                            Adicione usuários que poderam gerenciar esse álbum
                            juntamente com você.
                        </p>

                        <p class="my-2 font-bold">
                            Quem tem acesso a esse álbum:
                        </p>

                        <div class="flex flex-wrap gap-4 items-start">
                            <div
                                v-for="user in users"
                                class="bg-white rounded shadow leading-none flex overflow-hidden"
                            >
                                <span class="block py-2 px-3">
                                    {{ user.name }}
                                </span>

                                <button
                                    @click.prevent="confirmUserRemotion"
                                    class="flex items-center px-1 text-slate-400 bg-slate-50 border-l border-slate-100"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-x"
                                        width="16"
                                        height="16"
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
                                        <line x1="18" y1="6" x2="6" y2="18" />
                                        <line x1="6" y1="6" x2="18" y2="18" />
                                    </svg>
                                </button>

                                <!-- Delete Account Confirmation Modal -->
                                <DialogModal
                                    :show="confirmingUserRemotion"
                                    @close="closeModal"
                                >
                                    <template #title
                                        >Remover
                                        <strong class="text-red-600">{{
                                            user.name
                                        }}</strong>
                                        desse Álbum</template
                                    >

                                    <template #content>
                                        Você tem certeza que quer remover o
                                        usuário
                                        <strong class="text-red-600">{{
                                            user.name
                                        }}</strong>
                                        do gerenciamento desse álbum?
                                    </template>

                                    <template #footer>
                                        <SecondaryButton @click="closeModal">
                                            Cancelar
                                        </SecondaryButton>

                                        <DangerButton
                                            class="ml-3"
                                            :class="{
                                                'opacity-25':
                                                    removeUserForm.processing,
                                            }"
                                            :disabled="
                                                removeUserForm.processing
                                            "
                                            @click.prevent="
                                                removeUser(album.id, user.id)
                                            "
                                        >
                                            Remover
                                        </DangerButton>
                                    </template>
                                </DialogModal>
                            </div>
                        </div>
                    </template>

                    <template #form>
                        <!-- Email -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="user-email" value="Email" />

                            <TextInput
                                id="user-email"
                                v-model="addUserForm.email"
                                type="email"
                                class="mt-1 block w-full"
                            />
                            <InputError
                                :message="addUserForm.errors.email"
                                class="mt-2"
                            />
                        </div>
                    </template>

                    <template #actions>
                        <ActionMessage
                            :on="addUserForm.recentlySuccessful"
                            class="mr-3"
                        >
                            Saved.
                        </ActionMessage>

                        <PrimaryButton
                            :class="{ 'opacity-25': addUserForm.processing }"
                            :disabled="addUserForm.processing"
                        >
                            Adicionar
                        </PrimaryButton>
                    </template>
                </FormSection>
            </div>
        </div>
    </AppLayout>
</template>
