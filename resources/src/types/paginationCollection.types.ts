export interface IPaginationData<T> {
    data: T;
    links: ILink;
    meta: {
        current_page: number;
        from: number|null;
        last_page: number;
        links: IMetaLink[];
        path: string;
        per_page: number;
        to: number|null;
        total: number;
    };
}

interface ILink {
    first: string;
    last: string;
    prev: string|null;
    next: string|null;
}

interface IMetaLink {
    url: string|null;
    label: string;
    active: boolean;
}
