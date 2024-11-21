/**
 * Runs the setup function if a plugin is present in the page
 * 
 * @param {string[]} plugins - The list of plugins to be checked from the `<meta name="plugins">` tag
 * @param {CallableFunction} setupPlugin - The setup function for the plugin
 */
export function runPlugin(plugins, setupPlugin) {
    const pluginsMeta = document.querySelector(`meta[name="plugins"]`);

    if (!(pluginsMeta instanceof HTMLMetaElement)) {
        console.warn("Plugin meta tag is missing! Please ensure that the <meta name='plugins'> tag is included in the page.");
        return;
    }
    
    const loadedPlugins = pluginsMeta.content.replace(/\s+/g, '').split('|');
    const loaded = plugins.every(plugin => loadedPlugins.includes(plugin));

    if (loaded) {
        setupPlugin();
        return;
    }

    const missingPlugins = plugins.filter(plugin => !loadedPlugins.includes(plugin));
    console.debug(`Missing plugins: ${missingPlugins.join(', ')}. Required plugins: ${plugins.join(', ')}. Loaded plugins: ${loadedPlugins.join(', ')}. Plugin setup was not executed.`);
}
