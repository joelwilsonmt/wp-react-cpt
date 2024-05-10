import { generatePostTypeJSON } from './generatePostTypeJSON'
import { generateFieldGroupJSON } from './generateFieldGroupJSON'
import { writeJsonToFile } from './writeJSONToFile'
import pluginConfig from '../pluginConfig.json'
import { getPostTypeName } from './getPostTypeName'

const postTypeJSON = generatePostTypeJSON(pluginConfig.postType)
const fieldGroupJSON = generateFieldGroupJSON(
    pluginConfig.fieldGroups[0],
    getPostTypeName(pluginConfig.postType.postTypeSingularName)
)

writeJsonToFile('./plugin/json/custom-post-type.json', postTypeJSON)

writeJsonToFile('./plugin/json/custom-post-type-fields.json', fieldGroupJSON)
