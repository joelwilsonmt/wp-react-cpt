# WordPress Custom Post Type and React Shortcode Display

Vite-powered BunJS implementation of a WordPress plugin that registers a custom post type and consumes post type data in a React App.

## Config

Using the `pluginConfig.json` file in the root of the project, the `wp-react-cpt.php` registers a custom post type, and makes the custom post type's data available as an object on the `window`, which is then consumed by the React application located in the `/src` directory.

## Building

Run `bun run build` to build the react app and styles, copy the `pluginConfig.json` to the `/plugin` directory, and zip into WordPress plugin at project root.

## TODO:

-   Add support for registering custom fields through spec in `pluginConfig.json`
-   Interpolate `pluginConfig` names, version numbers, etc. into PHP file to be read by Wordpress
