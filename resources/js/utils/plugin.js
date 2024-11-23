/**
 * Runs the setup function if the given set of plugins is present in the page
 * 
 * @param {string[]|string} plugins - The list of plugins to be checked from the `<meta name="plugins">` tag
 * @param {CallableFunction} setupPlugin - The setup function for the plugin
 */
export function runPlugin(plugins, setupPlugin) {
    const pluginsMeta = document.querySelector(`meta[name="plugins"]`);

    if (!(pluginsMeta instanceof HTMLMetaElement)) {
        console.warn("Plugin meta tag is missing! Please ensure that the meta plugins tag is included in the page.");
        return;
    }
    
    const loadedPlugins = pluginsMeta.content.replace(/\s+/g, '').split('|');
    let loaded = false;

    if (typeof plugins === 'string') {
        loaded = loadedPlugins.includes(plugins);
    } else {
        loaded = plugins.every(plugin => loadedPlugins.includes(plugin));
    }

    if (loaded) {
        setupPlugin();
        return;
    }

    if (typeof plugins === 'string') {
        console.debug(`Missing plugin: ${plugins}. Loaded plugins: ${loadedPlugins.join(', ')}. Plugin setup was not executed.`);
    } else {
        const missingPlugins = plugins.filter(plugin => !loadedPlugins.includes(plugin));
        console.debug(`Missing plugins: ${missingPlugins.join(', ')}. Required plugins: ${plugins.join(', ')}. Loaded plugins: ${loadedPlugins.join(', ')}. Plugin setup was not executed.`);
    }
}
