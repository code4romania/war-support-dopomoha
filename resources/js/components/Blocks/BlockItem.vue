<template>
    <section class="bg-white border">
        <header class="relative flex items-stretch bg-gray-50">
            <div
                class="handle shrink-0 w-6 px-1.5 py-2 bg-gray-100 border-r cursor-move"
            >
                <icon name="drag" class="w-full h-full text-gray-400" local />
            </div>

            <button
                type="button"
                @click="toggleOpen"
                class="flex flex-wrap flex-1 p-3 space-x-1 text-sm font-semibold text-left text-gray-400 truncate focus:outline-none"
            >
                <icon
                    v-if="icon"
                    :name="icon"
                    class="w-5 h-5 mr-1 text-gray-500 shrink-0 group-hover:text-gray-600"
                />

                <h1 class="text-gray-900" v-text="$t(name)" />

                <span v-if="title">&mdash; {{ title }}</span>
            </button>

            <div class="relative flex items-center pr-3 space-x-3 shrink-0">
                <button
                    v-if="canExpand"
                    type="button"
                    @click="toggleWidth"
                    class="text-gray-400 hover:text-gray-900 focus:outline-none"
                >
                    <icon
                        v-if="content.fullwidth"
                        name="Media/fullscreen-exit-line"
                        class="block w-4 h-4"
                    />

                    <icon
                        v-else
                        name="Media/fullscreen-line"
                        class="block w-4 h-4"
                    />
                </button>

                <button
                    type="button"
                    @click="toggleOpen"
                    class="text-gray-400 hover:text-gray-900 focus:outline-none"
                >
                    <icon
                        name="System/arrow-down-s-line"
                        class="w-5 h-5 text-gray-400"
                        :class="{ 'rotate-180': open }"
                    />
                </button>

                <dropdown
                    trigger-class="flex items-center py-1 text-gray-400 hover:text-gray-900 focus:outline-none"
                    origin="top-right"
                    with-more
                >
                    <template #content>
                        <dropdown-item
                            v-if="canDuplicate"
                            type="button"
                            @click="$emit('duplicate')"
                            v-text="$t('app.action.duplicate')"
                        />

                        <dropdown-item
                            type="button"
                            @click="$emit('delete')"
                            v-text="$t('app.action.delete')"
                        />
                    </template>
                </dropdown>
            </div>
        </header>

        <div v-show="open" class="px-4 py-5 space-y-8 sm:p-6">
            <component
                :is="component"
                v-model:content="content"
                v-model:children="children"
                v-model:media="media"
                v-model:related="related"
            />

            <details v-if="$page.props.app.debug">
                <summary class="text-sm cursor-pointer">Debug</summary>
                <div class="p-3 text-sm bg-gray-100">
                    <pre class="whitespace-pre-line">
                        id: {{ id }}
                        component: {{ component }}
                        content:
                    </pre>

                    <pre class="whitespace-pre-wrap" v-text="content" />
                </div>
            </details>
        </div>
    </section>
</template>

<script>
    import { computed, ref } from 'vue';
    import { usePage } from '@inertiajs/inertia-vue3';
    import { useLocale } from '@/helpers';
    import get from 'lodash/get';

    export default {
        name: 'BlockItem',
        props: {
            id: {
                type: [String, Number],
                required: true,
            },
            type: {
                type: String,
                required: true,
                validator: (type) => ['block', 'repeater', 'form'].includes(type),
            },
            component: {
                type: String,
                required: true,
            },
            content: {
                type: Object,
                required: true,
            },
            children: {
                type: Array,
                default: () => [],
            },
            media: {
                type: Array,
                default: () => [],
            },
            related: {
                type: Array,
                default: () => [],
            },
            canDuplicate: {
                type: Boolean,
                default: false,
            },
            canExpand: {
                type: Boolean,
                default: false,
            },
        },
        emits: ['duplicate', 'delete'],
        setup(props) {
            const { currentLocale } = useLocale();

            const component = computed(() =>
                `${props.type}-${props.component}`.toLowerCase()
            );

            const name = computed(() => `block.${props.component}`);
            const title = computed(() =>
                get(props.content, `title.${currentLocale.value}`, null)
            );

            const icon = computed(() => {
                const block = usePage().props.value.model.blocks.find(
                    ({ type }) => type === props.component
                );

                if (typeof block === 'undefined' || !block.hasOwnProperty('icon')) {
                    return null;
                }

                return block.icon;
            });

            const toggleWidth = () => {
                props.content.fullwidth = !props.content.fullwidth;
            };

            const open = ref(true);

            const toggleOpen = () => {
                open.value = !open.value;
            };

            return {
                currentLocale,
                component,

                name,
                title,
                icon,
                toggleWidth,

                open,
                toggleOpen,
            };
        },
    };
</script>
