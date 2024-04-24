import ReactDOM from 'react-dom/client'
import App from './App.tsx'
import { default as pluginConfig } from '../pluginConfig.json'

ReactDOM.createRoot(
    document.getElementById(pluginConfig.reactEntryPointId)!
).render(<App />)
