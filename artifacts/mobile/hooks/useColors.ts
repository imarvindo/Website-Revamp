import { useColorScheme } from 'react-native';
import colors from '@/constants/colors';

type ColorScheme = typeof colors.dark;

export function useColors(): ColorScheme {
  // App is always dark-themed to match the SEO.ae brand
  return colors.dark;
}
