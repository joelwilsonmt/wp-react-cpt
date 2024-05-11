import { generatePostTypeJSON } from './generatePostTypeJSON'
import { generateFieldGroupJSON } from './generateFieldGroupJSON'
import { generateOptionsPageJSON } from './generateOptionsPageJSON'
import { writeJsonToFile } from './writeJSONToFile'
import pluginConfig from '../pluginConfig.json'
import { getPostTypeName } from './getPostTypeName'

const postTypeJSON = generatePostTypeJSON(pluginConfig.postType)
const fieldGroupJSON = generateFieldGroupJSON(
    pluginConfig.fieldGroups[0],
    getPostTypeName(pluginConfig.postType.postTypeSingularName)
)
const optionsPageJSON = generateOptionsPageJSON(
    pluginConfig.postType.postTypeSingularName,
    pluginConfig.optionsGroup
)

writeJsonToFile('./plugin/json/custom-post-type.json', postTypeJSON)

writeJsonToFile('./plugin/json/custom-post-type-fields.json', fieldGroupJSON)

writeJsonToFile('./plugin/json/options-page.json', optionsPageJSON)
