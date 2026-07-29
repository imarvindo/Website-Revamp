import React, { useState } from 'react';
import {
  ActivityIndicator,
  FlatList,
  Platform,
  Pressable,
  StyleSheet,
  Text,
  View,
} from 'react-native';
import { useColors } from '@/hooks/useColors';
import { useListServices } from '@workspace/api-client-react';
import type { Service } from '@workspace/api-client-react';
import { Feather, Ionicons } from '@expo/vector-icons';
import { useSafeAreaInsets } from 'react-native-safe-area-context';
import { router } from 'expo-router';
import * as Haptics from 'expo-haptics';

const CATEGORY_ICONS: Record<string, React.ComponentProps<typeof Ionicons>['name']> = {
  'Technical SEO': 'settings-outline',
  'Local SEO': 'location-outline',
  'E-commerce SEO': 'cart-outline',
  'Content': 'document-text-outline',
  'Link Building': 'link-outline',
  'Analytics': 'analytics-outline',
};

function ServiceCard({ item, onPress }: { item: Service; onPress: () => void }) {
  const colors = useColors();
  const iconName: React.ComponentProps<typeof Ionicons>['name'] =
    CATEGORY_ICONS[item.category] ?? 'search-outline';

  return (
    <Pressable
      style={({ pressed }) => [
        styles.card,
        {
          backgroundColor: colors.card,
          borderColor: colors.border,
          opacity: pressed ? 0.8 : 1,
        },
      ]}
      onPress={onPress}
    >
      <View style={styles.cardHeader}>
        <View style={[styles.iconBox, { backgroundColor: colors.secondary }]}>
          <Ionicons name={iconName} size={22} color={colors.primary} />
        </View>
        <View style={[styles.categoryBadge, { backgroundColor: colors.secondary }]}>
          <Text style={[styles.categoryText, { color: colors.mutedForeground }]}>
            {item.category}
          </Text>
        </View>
      </View>
      <Text style={[styles.title, { color: colors.foreground }]}>{item.title}</Text>
      <Text style={[styles.description, { color: colors.mutedForeground }]} numberOfLines={3}>
        {item.shortDescription}
      </Text>
      <View style={styles.footer}>
        <Text style={[styles.learnMore, { color: colors.primary }]}>Learn more</Text>
        <Feather name="arrow-right" size={14} color={colors.primary} />
      </View>
    </Pressable>
  );
}

export default function ServicesScreen() {
  const colors = useColors();
  const insets = useSafeAreaInsets();
  const topPad = Platform.OS === 'web' ? 67 : insets.top;
  const bottomPad = Platform.OS === 'web' ? 34 : insets.bottom + 60;

  const { data: services, isLoading, isError, refetch } = useListServices();

  const handlePress = (slug: string) => {
    Haptics.impactAsync(Haptics.ImpactFeedbackStyle.Light);
    router.push(`/service/${slug}`);
  };

  return (
    <View style={[styles.container, { backgroundColor: colors.background }]}>
      {/* Header */}
      <View style={[styles.header, { paddingTop: topPad + 12, borderBottomColor: colors.border }]}>
        <Text style={[styles.headerTitle, { color: colors.foreground }]}>Services</Text>
        <Text style={[styles.headerSubtitle, { color: colors.mutedForeground }]}>
          Full-spectrum SEO solutions
        </Text>
      </View>

      {isLoading ? (
        <ActivityIndicator color={colors.primary} style={styles.loader} />
      ) : isError ? (
        <View style={styles.errorState}>
          <Feather name="alert-circle" size={32} color={colors.destructive} />
          <Text style={[styles.errorText, { color: colors.mutedForeground }]}>
            Failed to load services
          </Text>
          <Pressable style={[styles.retryBtn, { borderColor: colors.primary }]} onPress={() => refetch()}>
            <Text style={[styles.retryText, { color: colors.primary }]}>Retry</Text>
          </Pressable>
        </View>
      ) : (
        <FlatList
          data={services ?? []}
          keyExtractor={(item) => item.slug}
          renderItem={({ item }) => (
            <ServiceCard item={item} onPress={() => handlePress(item.slug)} />
          )}
          contentContainerStyle={{
            paddingHorizontal: 16,
            paddingTop: 16,
            paddingBottom: bottomPad,
            gap: 12,
          }}
          showsVerticalScrollIndicator={false}
          scrollEnabled={!!(services && services.length > 0)}
          ListEmptyComponent={
            <View style={styles.emptyState}>
              <Feather name="inbox" size={32} color={colors.mutedForeground} />
              <Text style={[styles.emptyText, { color: colors.mutedForeground }]}>
                No services available
              </Text>
            </View>
          }
        />
      )}
    </View>
  );
}

const styles = StyleSheet.create({
  container: { flex: 1 },
  header: {
    paddingHorizontal: 20,
    paddingBottom: 16,
    borderBottomWidth: 1,
  },
  headerTitle: { fontSize: 28, fontFamily: 'Inter_700Bold', marginBottom: 2 },
  headerSubtitle: { fontSize: 14, fontFamily: 'Inter_400Regular' },
  loader: { marginTop: 60 },
  card: {
    padding: 16,
    borderRadius: 12,
    borderWidth: 1,
    gap: 10,
  },
  cardHeader: {
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'space-between',
  },
  iconBox: {
    width: 40,
    height: 40,
    borderRadius: 10,
    alignItems: 'center',
    justifyContent: 'center',
  },
  categoryBadge: {
    paddingHorizontal: 10,
    paddingVertical: 4,
    borderRadius: 6,
  },
  categoryText: { fontSize: 11, fontFamily: 'Inter_500Medium' },
  title: { fontSize: 16, fontFamily: 'Inter_700Bold', lineHeight: 22 },
  description: { fontSize: 13, fontFamily: 'Inter_400Regular', lineHeight: 19 },
  footer: { flexDirection: 'row', alignItems: 'center', gap: 4, marginTop: 2 },
  learnMore: { fontSize: 13, fontFamily: 'Inter_600SemiBold' },
  errorState: { alignItems: 'center', paddingTop: 60, gap: 12 },
  errorText: { fontSize: 14, fontFamily: 'Inter_400Regular' },
  retryBtn: {
    paddingVertical: 10,
    paddingHorizontal: 24,
    borderRadius: 8,
    borderWidth: 1.5,
    marginTop: 4,
  },
  retryText: { fontSize: 14, fontFamily: 'Inter_600SemiBold' },
  emptyState: { alignItems: 'center', paddingTop: 60, gap: 8 },
  emptyText: { fontSize: 14, fontFamily: 'Inter_400Regular' },
});
