import fs from 'fs'

export const writeJsonToFile = (outputFilePath, data) => {
    fs.writeFile(
        outputFilePath,
        JSON.stringify(data, null, 2),
        'utf8',
        (err) => {
            if (err) {
                console.error('Error writing to file:', err)
                return
            }
            console.log('File has been saved.')
        }
    )
}
