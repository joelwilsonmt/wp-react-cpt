import { type Field, isChoiceField } from './defaultFields'

type InputFieldGroup = {
    key: string
    title: string
    fields: Field[]
}

type OutputField = {
    key: string
    label: string
    name: string
    type: string
    instructions: string
    required: boolean
    wrapper?: {
        width: string
        class: string
        id: string
    }
    placeholder?: string
}

type OutputFieldGroup = {
    key: string
    title: string
    fields: OutputField[]
    location: { param: string; operator: string; value: string }[][]
    menu_order: number
    position: string
    style: string
    label_placement: string
    instruction_placement: string
    hide_on_screen: string
    active: boolean
    description: string
    show_in_rest: number
}

export const generateFieldGroupJSON = (
    group: InputFieldGroup,
    postTypeName: string,
    generateNewFieldsKeys?: boolean
): OutputFieldGroup => {
    return {
        key: generateNewFieldsKeys
            ? 'group_' + Math.random().toString(16).slice(2, 10)
            : group.key,
        title: group.title,
        fields: group.fields.map((field) => {
            // Start with the mandatory fields
            const transformedField = {
                key: generateNewFieldsKeys
                    ? 'field_' + Math.random().toString(16).slice(2, 10)
                    : field.key,

                label: field.label,
                name: field.name,
                type: field.type,
                instructions: '',
                required: field.required === 1,
            }

            // Conditionally add optional fields if they exist
            if (field.allow_custom !== undefined)
                transformedField['allow_custom'] = field.allow_custom
            if (field.save_custom !== undefined)
                transformedField['save_custom'] = field.save_custom
            if (field.other_choice !== undefined)
                transformedField['other_choice'] = field.other_choice
            if (field.save_other_choice !== undefined)
                transformedField['save_other_choice'] = field.save_other_choice
            if (isChoiceField(field) && field.choices)
                transformedField['choices'] = field.choices
            if (field.display_format)
                transformedField['display_format'] = field.display_format
            if (field.return_format)
                transformedField['return_format'] = field.return_format
            if (field.preview_size)
                transformedField['preview_size'] = field.preview_size
            if (field.library) transformedField['library'] = field.library
            if (field.center_lat)
                transformedField['center_lat'] = field.center_lat
            if (field.center_lng)
                transformedField['center_lng'] = field.center_lng
            if (field.zoom) transformedField['zoom'] = field.zoom
            if (field.height) transformedField['height'] = field.height

            return transformedField
        }),
        location: [
            [
                {
                    param: 'post_type',
                    operator: '==',
                    value: postTypeName,
                },
            ],
        ],
        menu_order: 0,
        position: 'normal',
        style: 'default',
        label_placement: 'top',
        instruction_placement: 'label',
        hide_on_screen: '',
        active: true,
        description: '',
        show_in_rest: 0,
    }
}
