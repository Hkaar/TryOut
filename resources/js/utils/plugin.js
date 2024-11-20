/**
 * Runs the setup function if a plugin is present in the page
 * 
 * @param {string[]} plugins - The list of plugins to be checked from the `<meta name="plugins">` tag
 * @param {CallableFunction} setupPlugin - The setup function for the plugin
 */
export function runPlugin(plugins, setupPlugin) {
    const pluginsMeta = document.querySelector(`meta[name="plugins"]`);

    if (!(pluginsMeta instanceof HTMLMetaElement)) {
        console.warn("Plugin meta tag is not present!");
        return;
    }

    const loadedPlugins = pluginsMeta.content.replace(' ', '').split('|');
    const loaded = plugins.every(plugin => loadedPlugins.includes(plugin))

    if (loaded) {
        setupPlugin();
        return;
    }

    console.debug(`Plugin not loaded due to missing full set of ${plugins}!`);
}