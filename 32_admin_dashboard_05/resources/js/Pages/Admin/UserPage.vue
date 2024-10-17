<script setup>
import { router, useForm } from "@inertiajs/vue3";
import Title from "../../Components/Title.vue";
import InputField from "../../Components/InputField.vue";
import PaginationLinks from "../../Components/PaginationLinks.vue";
import SessionMessages from "../../Components/SessionMessages.vue";

const props = defineProps({
    user: Object,
    listings: Object,
    status: String,
});

const params = route().params;
const form = useForm({ search: params.search });

const search = () => {
    router.get(
        route("user.show", {
            user: props.user.id,
            search: form.search,
            disapproved: params.disapproved
        })
    );
};

const showDisapproved = (e) => {
    if (e.target.checked) {
        router.get(
            route("user.show", {
                user: props.user.id,
                search: params.search,
                disapproved: true,
            })
        );
    } else {
        router.get(
            route("user.show", {
                user: props.user.id,
                search: params.search,
                disapproved: null,
            })
        );
    }
};

const toggleApprove = (listing) => {
    let msg = listing.approved
        ? "Disapprove this listing?"
        : "Approve this listing?";

    if (confirm(msg)) {
        router.put(route("admin.approve", listing.id));
    }
};
</script>

<template>
    <Head :title="`- ${user.name} Listings`" />

    <SessionMessages :status="status" />
    <!-- Heading -->
    <div class="mb-6">
        <Title>{{ user.name }} latest listings</Title>
        <div class="flex items-end justify-between">
            <div class="flex items-end gap-2">
                <!-- Search form -->
                <form @submit.prevent="search">
                    <InputField
                        label=""
                        icon="magnifying-glass"
                        placeholder="Search..."
                        v-model="form.search"
                    />
                </form>
                <Link
                    class="px-2 py-[6px] rounded-md bg-indigo-500 text-white flex items-center gap-2"
                    v-if="params.search"
                    :href="
                        route('user.show', {
                            ...params,
                            search: null,
                            page: null,
                            user: user.id,
                        })
                    "
                >
                    {{ params.search }}
                    <i class="fa-solid fa-xmark"></i>
                </Link>
            </div>

            <!-- Toggle approve listing btn -->
            <div
                class="flex items-center gap-1 text-xs hover:bg-slate-300 dark:hover:bg-slate-800 px-2 py-1 rounded-md"
            >
                <input
                    @input="showDisapproved"
                    :checked="params.disapproved"
                    type="checkbox"
                    id="showDisapproved"
                    class="rounded-md border-1 outline-0 text-indigo-500 ring-indigo-500 border-slate-700 cursor-pointer"
                />
                <label
                    for="showDisapproved"
                    class="block text-sm font-medium text-slate-700 dark:text-slate-300 cursor-pointer"
                >
                    Show disapproved listings
                </label>
            </div>
        </div>
    </div>

    <!-- Table -->
    <table
        class="bg-white dark:bg-slate-800 w-full rounded-lg overflow-hidden ring-1 ring-slate-300"
    >
        <thead>
            <tr class="bg-slate-600 text-slate-300 uppercase text-xs text-left">
                <th class="w-4/6 p-3">Title</th>
                <th class="w-2/6 p-3 text-center">Approved</th>
                <th class="w-1/6 p-3 text-right">View</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-slate-300 divide-dashed">
            <tr v-for="listing in listings.data" :key="listing.id">
                <td class="py-5 px-3">{{ listing.title }}</td>

                <td class="py-5 px-3 text-2xl text-center">
                    <button @click.prevent="toggleApprove(listing)">
                        <i
                            :class="`fa-solid fa-${
                                listing.approved
                                    ? 'circle-check text-green-400'
                                    : 'circle-xmark text-red-400'
                            }`"
                        ></i>
                    </button>
                </td>

                <td class="w-1/6 py-5 px-3 text-right">
                    <Link
                        :href="route('listing.show', listing.id)"
                        class="fa-solid fa-up-right-from-square px-3 text-indigo-400"
                    ></Link>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="mt-6">
        <PaginationLinks :paginator="listings" />
    </div>
</template>
