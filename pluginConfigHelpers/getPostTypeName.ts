import * as changeCase from 'change-case'

export const getPostTypeName = (postTypeName: string) => {
    return changeCase.kebabCase(postTypeName) + '-type'
}
