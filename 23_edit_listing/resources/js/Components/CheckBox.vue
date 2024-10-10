<script setup>
const model = defineModel();

defineProps({
    name: String,
});
</script>

<template>
    <div class="flex items-center gap-2">
        <input
            type="checkbox"
            v-model="model"
            :id="name"
            class="rounded-md border-1 outline-0 text-indigo-500 ring-indigo-500 border-slate-700"
        />
        <label
            :for="name"
            class="block text-sm font-medium text-slate-700 dark:text-slate-300 cursor-pointer"
        >
            <slot />
        </label>
    </div>
</template>
