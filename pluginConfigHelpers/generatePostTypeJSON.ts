import { getPostTypeName } from './getPostTypeName'

type InputJson = {
    postTypeKey: string
    postTypeSingularName: string
    postTypePluralName: string
    menuIcon?: string
}

type OutputJson = {
    key: string
    title: string
    menu_order: number
    active: boolean
    post_type: string
    advanced_configuration: boolean
    import_source: string
    import_date: string
    labels: Record<string, string>
    description: string
    public: boolean
    hierarchical: boolean
    exclude_from_search: boolean
    publicly_queryable: boolean
    show_ui: boolean
    show_in_menu: boolean
    admin_menu_parent: string
    show_in_admin_bar: boolean
    show_in_nav_menus: boolean
    show_in_rest: boolean
    rest_base: string
    rest_namespace: string
    rest_controller_class: string
    menu_position: string
    menu_icon: string
    rename_capabilities: boolean
    singular_capability_name: string
    plural_capability_name: string
    supports: string[]
    taxonomies: string[]
    has_archive: boolean
    has_archive_slug: string
    rewrite: {
        permalink_rewrite: string
        with_front: string
        feeds: string
        pages: string
    }
    query_var: string
    query_var_name: string
    can_export: boolean
    delete_with_user: boolean
    register_meta_box_cb: string
    enter_title_here: string
}

export const generatePostTypeJSON = (
    input: InputJson,
    generateNewPostTypeKey?: boolean
): OutputJson => {
    const { postTypeSingularName, postTypePluralName } = input
    const baseType = getPostTypeName(postTypeSingularName)

    return {
        key: generateNewPostTypeKey
            ? 'post_type_' + Math.random().toString(16).slice(2, 10)
            : input.postTypeKey,
        title: input.postTypePluralName,
        menu_order: 0,
        active: true,
        post_type: baseType,
        advanced_configuration: true,
        import_source: '',
        import_date: '',
        labels: {
            name: input.postTypePluralName,
            singular_name: postTypeSingularName,
            menu_name: postTypePluralName,
            all_items: 'All ' + postTypePluralName,
            edit_item: 'Edit ' + postTypePluralName,
            view_item: 'View ' + postTypePluralName,
            view_items: 'View ' + postTypePluralName,
            add_new_item: 'Add New ' + postTypeSingularName,
            add_new: 'Add New ' + postTypeSingularName,
            new_item: 'New ' + postTypeSingularName,
            parent_item_colon: 'Parent ' + postTypeSingularName + ':',
            search_items: 'Search ' + postTypePluralName,
            not_found: 'No ' + postTypePluralName + ' found',
            not_found_in_trash: 'No ' + postTypePluralName + ' found in Trash',
            archives: postTypePluralName + ' Archives',
            attributes: postTypePluralName + ' Attributes',
            featured_image: '',
            set_featured_image: '',
            remove_featured_image: '',
            use_featured_image: '',
            insert_into_item: 'Insert into ' + postTypeSingularName,
            uploaded_to_this_item: 'Uploaded to this ' + postTypeSingularName,
            filter_items_list: 'Filter ' + postTypePluralName + ' list',
            filter_by_date: 'Filter ' + postTypePluralName + ' by date',
            items_list_navigation: postTypePluralName + ' list navigation',
            items_list: postTypePluralName + ' list',
            item_published: postTypeSingularName + ' published.',
            item_published_privately:
                postTypeSingularName + ' published privately.',
            item_reverted_to_draft:
                postTypeSingularName + ' reverted to draft.',
            item_scheduled: postTypeSingularName + ' scheduled.',
            item_updated: postTypeSingularName + ' updated.',
            item_link: postTypeSingularName + ' Link',
            item_link_description: 'A link to a ' + postTypeSingularName + '.',
        },
        description: '',
        public: true,
        hierarchical: false,
        exclude_from_search: false,
        publicly_queryable: true,
        show_ui: true,
        show_in_menu: true,
        admin_menu_parent: '',
        show_in_admin_bar: true,
        show_in_nav_menus: true,
        show_in_rest: true,
        rest_base: '',
        rest_namespace: 'wp/v2',
        rest_controller_class: 'WP_REST_Posts_Controller',
        menu_position: '',
        menu_icon: input.menuIcon || 'dashicons-clipboard',
        rename_capabilities: false,
        singular_capability_name: 'post',
        plural_capability_name: 'posts',
        supports: ['title', 'author', 'editor', 'thumbnail', 'custom-fields'],
        taxonomies: ['category', 'post_tag'],
        has_archive: false,
        has_archive_slug: '',
        rewrite: {
            permalink_rewrite: 'post_type_key',
            with_front: '1',
            feeds: '0',
            pages: '1',
        },
        query_var: 'post_type_key',
        query_var_name: '',
        can_export: true,
        delete_with_user: false,
        register_meta_box_cb: '',
        enter_title_here: '',
    }
}
