<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
});
</script>

<template>
    <Head title="Home" />

    <div
        class="flex flex-col items-center justify-center min-h-screen bg-gray-100"
    >
        <h1
            class="text-center font-black tracking-tighter leading-none text-indigo-700 text-4xl mb-4"
        >
            MeuÁlbum<br />
            Copa 2022
        </h1>

        <p class="px-4 text-center tracking-tighter text-slate-700 text-xl">
            Um jeito mais fácil de gerenciar suas figurinhas do álbum da Copa de
            2022!
        </p>

        <div v-if="canLogin" class="px-6 py-4">
            <Link
                v-if="$page.props.user"
                :href="route('dashboard')"
                class="text-xl font-black tracking-tighter text-indigo-700 underline"
                >Dashboard</Link
            >

            <template v-else>
                <Link
                    :href="route('login')"
                    class="text-xl font-black tracking-tighter text-indigo-700 underline"
                    >Log in</Link
                >

                <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class="ml-4 text-xl font-black tracking-tighter text-indigo-700 underline"
                    >Register</Link
                >
            </template>
        </div>
    </div>
</template>
