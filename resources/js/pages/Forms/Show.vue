<template>
    <layout :title="resource.title" :description="resource.description">
        <template #actions>
            <inertia-link
                class="relative inline-flex items-center justify-center px-4 py-2 text-sm font-semibold tracking-wider text-white transition duration-150 ease-in-out bg-gray-800 border border-transparent focus:outline-none focus:ring-2 focus:ring-offset-2 hover:bg-gray-700 active:bg-gray-900 focus:border-gray-900 disabled:opacity-50 disabled:cursor-default"
                :href="route('admin.forms.edit', { form: resource.id })"
                v-text="$t('app.action.edit')"
            />
        </template>

        <inertia-table
            :collection="collection"
            disable-create
            disable-filters
        />
    </layout>
</template>

<script>
    import { computed } from 'vue';

    export default {
        props: {
            collection: Object,
            resource: Object,
            model: Object,
        },
        setup(props) {
            const action = computed(() =>
                props.resource === undefined ? 'create' : 'edit'
            );

            return {
                action,
            };
        },
    };
</script>
