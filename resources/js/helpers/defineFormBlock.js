import camelCase from 'lodash/camelCase';
import upperFirst from 'lodash/upperFirst';
import { useBlock } from '@/helpers';
export default function (block) {
    return {
        name: 'FormBlock' + upperFirst(camelCase(block.type)),
        props: {
            content: {
                type: Object,
                default: () => ({}),
            },
            ...block.props,
        },
        emits: ['update:content'],
        setup(props) {
            const { initializeFields } = useBlock();

            initializeFields(block, props);
        },
    };
}
