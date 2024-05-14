import { type Field, type SimpleField, createField } from './defaultFields'
import { getPostTypeName } from './getPostTypeName'

type OptionsGroup = {
    fields: SimpleField[]
}

type ACFGroup = {
    key: string
    title: string
    fields: Field[]
    location: Array<Array<{ param: string; operator: string; value: string }>>
    menu_order: number
    position: string
    style: string
    label_placement: string
    instruction_placement: string
    hide_on_screen: string[]
}

export const generateOptionsPageJSON = (
    postTypeName: string,
    optionsGroup: OptionsGroup
): ACFGroup => {
    const slug = getPostTypeName(postTypeName)
    return {
        key: `${slug}-options-group`,
        title: `${postTypeName} Options Page`,
        fields: optionsGroup.fields.map((f) => createField(f)),
        location: [
            [
                {
                    param: 'options_page',
                    operator: '==',
                    value: `${slug}-options`, // This slug should match your actual options page slug
                },
            ],
        ],
        menu_order: 0,
        position: 'normal',
        style: 'default',
        label_placement: 'top',
        instruction_placement: 'label',
        hide_on_screen: [],
    }
}
