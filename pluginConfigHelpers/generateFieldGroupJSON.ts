export type InputField = {
    key: string
    label: string
    name: string
    type: string
    instructions: string
    required?: number
    choices?: Record<string, string>
    allow_custom?: number
    save_custom?: number
    other_choice?: number
    save_other_choice?: number
    display_format?: string
    return_format?: string
    preview_size?: string
    library?: string
    center_lat?: string
    center_lng?: string
    zoom?: number
    height?: number
    googleMapsAPIKey?: string
}

type InputFieldGroup = {
    key: string
    title: string
    fields: InputField[]
}

type OutputField = {
    key: string
    label: string
    name: string
    type: string
    instructions: string
    required: boolean
    conditional_logic: number
    wrapper: {
        width: string
        class: string
        id: string
    }
    default_value: string
    maxlength: string
    placeholder: string
    prepend: string
    append: string
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
    postTypeName: string
): OutputFieldGroup => {
    return {
        key: group.key || 'group_' + Math.random().toString(16).slice(2, 10),
        title: group.title,
        fields: group.fields.map((field) => {
            // Start with the mandatory fields
            const transformedField = {
                key:
                    field.key ||
                    'field_' + Math.random().toString(16).slice(2, 10),
                label: field.label,
                name: field.name,
                type: field.type,
                instructions: '',
                required: field.required === 1,
                conditional_logic: 0,
                wrapper: {
                    width: '',
                    class: '',
                    id: '',
                },
                default_value: '',
                maxlength: '',
                placeholder: '',
                prepend: '',
                append: '',
            }

            // Conditionally add optional fields if they exist
            if (field.allow_custom !== undefined) {
                transformedField['allow_custom'] = field.allow_custom
            }
            if (field.save_custom !== undefined) {
                transformedField['save_custom'] = field.save_custom
            }
            if (field.other_choice !== undefined) {
                transformedField['other_choice'] = field.other_choice
            }
            if (field.save_other_choice !== undefined) {
                transformedField['save_other_choice'] = field.save_other_choice
            }
            if (field.choices) {
                transformedField['choices'] = field.choices
            }

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
