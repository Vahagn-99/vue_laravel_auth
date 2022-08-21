<template>
    <div>
        <img class="mx-auto h-12 w-auto" :src="AuthLogo" alt="Workflow" />
        <h2
            class="mt-6 text-center text-3xl tracking-tight font-bold text-gray-900"
        >
            <slot name="title"></slot>
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600">
            Or
            <slot name="subTitle"></slot>
        </p>
    </div>
</template>

<script setup>
import { ref } from "@vue/reactivity";

const props = defineProps({
    logo: String,
});
let AuthLogo = ref(props.logo);
</script>

<style scoped></style>