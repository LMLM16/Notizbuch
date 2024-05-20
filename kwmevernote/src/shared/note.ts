import { Image } from "./image";
import { Tag } from "./tag";
export { Image } from "./image";
import { User } from "./user";
export { User } from "./user";

export class Note {
constructor(
public id: number,
public user_id: number,
public title: string,
public content: string,
public user: User[],
public rating: number,
public tags?: Tag[],
public subtitle?: string,
public images?: Image[],
public list_id?: number,
public published?: Date,
) {}
}

