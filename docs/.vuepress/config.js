module.exports = {
    title: 'Locaravel',
    description: 'Geolocalização na palma da mão',
    themeConfig: {
        // Assumes GitHub. Can also be a full GitLab url.
        repo: 'ricardosierra/locaravel',
        // Customising the header label
        // Defaults to "GitHub"/"GitLab"/"Bitbucket" depending on `themeConfig.repo`
        repoLabel: 'Contribute!',

        // Optional options for generating "Edit this page" link

        // if your docs are in a different repo from your main project:
        docsRepo: 'ricardosierra/locaravel',
        // if your docs are not at the root of the repo:
        docsDir: 'docs',
        // if your docs are in a specific branch (defaults to 'master'):
        docsBranch: 'master',
        // defaults to false, set to true to enable
        editLinks: true,
        // custom text for edit link. Defaults to "Edit this page"
        editLinkText: 'Help us improve this page!',
        displayAllHeaders: true, // Default: false
        sidebar: [
            '/',
            '/page-a',
            ['/page-b', 'Explicit link text'],
            {
                title: 'Group 1',   // required
                path: '/foo/',      // optional, link of the title, which should be an absolute path and must exist
                collapsable: false, // optional, defaults to true
                sidebarDepth: 1,    // optional, defaults to 1
                children: [
                '/'
                ]
            },
            {
                title: 'Group 2',
                children: [ /* ... */ ]
            }
        ]
    }
}