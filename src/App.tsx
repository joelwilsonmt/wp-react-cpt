import './App.css'
import { default as pluginConfig } from '../pluginConfig.json'
import { Window } from './types'

function App() {
    const data = (window as Window)[pluginConfig.postTypeDTOName]
    console.log('data in app', data)
    return (
        <>
            <div>
                <h1>{pluginConfig.pluginName}</h1>
                <h2>With Custom WordPress Post Type(s)</h2>
            </div>
        </>
    )
}

export default App
