import * as changeCase from 'change-case'

export enum InputType {
    Text = 'text',
    Textarea = 'textarea',
    Number = 'number',
    Select = 'select',
    Radio = 'radio',
    Checkbox = 'checkbox',
    DatePicker = 'date_picker',
    Image = 'image',
    File = 'file',
    Gallery = 'gallery',
    GoogleMap = 'google_map',
}

type InputBase = {
    key: string
    label: string
    name: string
    type: InputType
    instructions: string
    required: number
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
}

type NonChoiceField = InputBase & {
    type: Exclude<
        InputType,
        [InputType.Radio, InputType.Checkbox, InputType.Select]
    >
}

export type ChoiceField = InputBase & {
    type: InputType.Radio | InputType.Checkbox | InputType.Select
    choices: string[] | Record<string, string>
}

export function isChoiceField(field: Field): field is ChoiceField {
    return (
        field.type === InputType.Radio ||
        field.type === InputType.Checkbox ||
        field.type === InputType.Select
    )
}

export type Field = NonChoiceField | ChoiceField

const text = {
    required: 0,
}

const number = {
    required: 0,
}

const textarea = {
    required: 0,
}

const select = {
    required: 0,
    options: [],
}

const checkbox = {
    required: 0,
    choices: [],
    allow_custom: 1,
    save_custom: 1,
}

const radio = {
    required: 0,
    choices: [],
    other_choice: 1,
    save_other_choice: 1,
}

const date_picker = {
    required: 0,
    display_format: 'd/m/Y',
    return_format: 'd/m/Y',
}

const image = {
    required: 0,
    return_format: 'url',
    preview_size: 'thumbnail',
    library: 'all',
}

const file = {
    required: 0,
    return_format: 'url',
    library: 'all',
}

const gallery = {
    required: 0,
    preview_size: 'thumbnail',
    library: 'all',
}

const google_map = {
    required: 0,
    center_lat: '46.88',
    center_lng: '-110.36',
    zoom: 6,
    height: 350,
}

const fields = {
    text,
    number,
    textarea,
    select,
    radio,
    checkbox,
    date_picker,
    image,
    file,
    gallery,
    google_map,
}

type SimpleField = {
    label: string
    type: InputType
    instructions: string
    required?: number
    key?: string
}

const createFieldBase = (baseField: SimpleField) => {
    const snakeCaseLabel = changeCase.snakeCase(baseField.label)
    return {
        key: baseField.key || Math.random().toString(36).substring(7),
        name: snakeCaseLabel,
        ...baseField,
    }
}

export const createField = (baseField: SimpleField): Field => {
    return {
        ...fields[baseField.type],
        ...createFieldBase(baseField),
    }
}
