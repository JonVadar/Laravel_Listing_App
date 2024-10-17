<script setup>
import { useForm } from "@inertiajs/vue3";

const props = defineProps({ user: Object });

const form = useForm({ role: props.user.role });

const submit = () => {
    if (confirm(`Change this user's role to ${form.role}?`)) {
        form.put(route("admin.role", props.user.id));
    } else {
        form.role = props.user.role;
    }
};
</script>

<template>
    <div class="flex items-center gap-2">
        <form @change="submit" class="flex items-center gap-2">
            <label for="roles" class="sr-only">Roles:</label>
            <select
                v-model="form.role"
                name="roles"
                class="text-slate-800 bg-slate-200 text-xs py-1 border-0 outline-0 rounded-lg"
            >
                <option value="admin">Admin</option>

                <option value="general">General</option>

                <option value="suspended">Suspended</option>
            </select>
        </form>
    </div>
</template>
