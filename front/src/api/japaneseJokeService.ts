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
    const themes: JapaneseJokeTheme[] = response.data
    const randomIndex = Math.floor(Math.random() * themes.length)
    return themes[randomIndex]
  },

  /**
   * Get submissions for a specific theme
   */
  getSubmissions: async (themeId: number): Promise<JapaneseJokePost[]> => {
    const response = await apiClient.get(`/dajare/submissions/${themeId}`)
    return response.data
  },

  /**
   * Submit a new dajare
   */
  submitDajare: async (submission: { 
    theme_id: number, 
    content: string, 
    author_name?: string 
  }): Promise<JapaneseJokePost> => {
    const response = await apiClient.post('/dajare/submit', submission)
    return response.data
  }
}