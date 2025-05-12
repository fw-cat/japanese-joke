import apiClient from './config'

export interface JapaneseJokeTheme {
  id: number
  theme: string
  created_at: string
}

export interface JapaneseJokePost {
  id: number
  theme_id: number
  content: string
  author_name?: string
  created_at: string
}

export const japaneseJokeService = {
  /**
   * Get a random dajare theme
   */
  getRandomTheme: async (): Promise<JapaneseJokeTheme> => {
    const response = await apiClient.get('/theme')
    const themes: JapaneseJokeTheme[] = response.data.themes
    const randomIndex = Math.floor(Math.random() * themes.length)
    return themes[randomIndex]
  },

  /**
   * Get posts for a specific theme
   */
  getPosts: async (themeId: number): Promise<JapaneseJokePost[]> => {
    const response = await apiClient.get(`/theme/${themeId}`)
    return response.data.posts
  },

  /**
   * Submit a new dajare
   */
  submitJapaneseJoke: async (post: { 
    theme_id: number, 
    content: string, 
    author_name?: string 
  }): Promise<JapaneseJokePost> => {
    const response = await apiClient.post('/posts', post)
    return response.data
  }
}