<template>
    <localized-field
        field="form-input"
        :label="$t('field.title')"
        v-model="content.title"
    />

    <form-select
        :label="$t('field.align')"
        v-model="content.align"
        :options="
            alignmentOptions.map((align) => ({
                value: align,
                label: $t(`align.${align}`),
            }))
        "
    />

    <localized-field
        field="form-editor"
        :label="$t('field.text')"
        v-model="content.text"
    />
</template>

<script>
    import { defineBlock } from '@/helpers';

    export default defineBlock({
        type: 'header',
        icon: 'Design/collage-line',
        fields: {
            title: Object,
            text: Object,
            align: String,
        },
        setup(props) {
            const alignmentOptions = ['left', 'center'];

            if (!props.content.align) {
                props.content.align = alignmentOptions[0];
            }

            return {
                alignmentOptions,
            };
        },
    });
</script>
