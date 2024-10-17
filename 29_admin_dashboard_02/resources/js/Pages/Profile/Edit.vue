<script setup>
import UpdateInfo from "./Sections/UpdateInfo.vue";
import UpdatePassword from "./Sections/UpdatePassword.vue";
import DeleteAccount from "./Sections/DeleteAccount.vue";

defineProps({
    user: Object,
    status: String,
});
</script>

<template>
    <Head title="- Profile" />
    <UpdateInfo :user="user" :status="status" />
    <UpdatePassword />
    <DeleteAccount />
</template>
