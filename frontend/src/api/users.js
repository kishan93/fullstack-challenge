import { apiBaseUrl } from "@/constants.js";

export const fetchUsersData = async () => {
  const url = `${apiBaseUrl}/users`;
  return await (await fetch(url)).json();
};
