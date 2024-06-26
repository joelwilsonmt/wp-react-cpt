import { generatePostTypeJSON } from './generatePostTypeJSON'
import { generateFieldGroupJSON } from './generateFieldGroupJSON'
import { generateOptionsPageJSON } from './generateOptionsPageJSON'
import { writeJsonToFile } from './writeJSONToFile'
import pluginConfig from '../pluginConfig.json'
import { getPostTypeName } from './getPostTypeName'
import { createField } from './defaultFields'

const postTypeJSON = generatePostTypeJSON(
    pluginConfig.postType,
    pluginConfig.generateNewPostTypeKey
)
const fieldGroupJSON = generateFieldGroupJSON(
    {
        ...pluginConfig.fieldGroups[0],
        fields: [
            ...pluginConfig.fieldGroups[0].fields.map((f) =>
                createField(f, pluginConfig.generateNewFieldsKeys)
            ),
        ],
    },
    getPostTypeName(pluginConfig.postType.postTypeSingularName),
    pluginConfig.generateNewFieldsKeys
)
const optionsPageJSON = generateOptionsPageJSON(
    pluginConfig.postType.postTypeSingularName,
    pluginConfig.postTypeOptionsGroup
)

writeJsonToFile('./plugin/json/custom-post-type.json', postTypeJSON)

writeJsonToFile('./plugin/json/custom-post-type-fields.json', fieldGroupJSON)

writeJsonToFile('./plugin/json/options-page.json', optionsPageJSON)
